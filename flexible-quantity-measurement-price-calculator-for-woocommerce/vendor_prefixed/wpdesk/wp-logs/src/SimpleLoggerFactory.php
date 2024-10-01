<?php

declare (strict_types=1);
namespace WDFQVendorFree\WPDesk\Logger;

use WDFQVendorFree\Monolog\Handler\FingersCrossedHandler;
use WDFQVendorFree\Monolog\Handler\HandlerInterface;
use WDFQVendorFree\Monolog\Logger;
use WDFQVendorFree\Monolog\Handler\ErrorLogHandler;
use WDFQVendorFree\Monolog\Processor\PsrLogMessageProcessor;
use WDFQVendorFree\Monolog\Processor\UidProcessor;
use Psr\Log\LogLevel;
use WDFQVendorFree\WPDesk\Logger\WC\WooCommerceHandler;
final class SimpleLoggerFactory implements \WDFQVendorFree\WPDesk\Logger\LoggerFactory
{
    /**
     * @var array{
     *   level?: string,
     *   action_level?: string|null,
     * }
     */
    private $options;
    /** @var string */
    private $channel;
    /** @var Logger */
    private $logger;
    /**
     * Valid options are:
     *   * level (default debug): Default logging level
     *   * action_level: If value is set, it will act as the minimum level at which logger will be triggered using FingersCrossedHandler {@see https://seldaek.github.io/monolog/doc/02-handlers-formatters-processors.html#wrappers--special-handlers}
     */
    public function __construct(string $channel, $options = null)
    {
        $this->channel = $channel;
        $options = $options ?? new \WDFQVendorFree\WPDesk\Logger\Settings();
        if ($options instanceof \WDFQVendorFree\WPDesk\Logger\Settings) {
            $options = $options->to_array();
        }
        $this->options = \array_merge(['level' => \Psr\Log\LogLevel::DEBUG, 'action_level' => null], $options);
    }
    public function getLogger($name = null) : \WDFQVendorFree\Monolog\Logger
    {
        if ($this->logger) {
            return $this->logger;
        }
        $this->logger = new \WDFQVendorFree\Monolog\Logger($this->channel, [], [new \WDFQVendorFree\Monolog\Processor\PsrLogMessageProcessor(null, \true), new \WDFQVendorFree\Monolog\Processor\UidProcessor()], \wp_timezone());
        if (\function_exists('wc_get_logger') && \did_action('woocommerce_init')) {
            $this->set_wc_handler();
        } else {
            \add_action('woocommerce_init', [$this, 'set_wc_handler']);
        }
        // In the worst-case scenario, when WC logs are not available (yet, or at all),
        // fallback to WP logs, but only when enabled.
        if (empty($this->logger->getHandlers()) && \defined('WDFQVendorFree\\WP_DEBUG_LOG') && WP_DEBUG_LOG) {
            $this->set_handler($this->logger, new \WDFQVendorFree\Monolog\Handler\ErrorLogHandler(\WDFQVendorFree\Monolog\Handler\ErrorLogHandler::OPERATING_SYSTEM, $this->options['level']));
        }
        return $this->logger;
    }
    /**
     * @internal
     */
    public function set_wc_handler() : void
    {
        $this->set_handler($this->logger, new \WDFQVendorFree\WPDesk\Logger\WC\WooCommerceHandler(\wc_get_logger(), $this->channel));
    }
    private function set_handler(\WDFQVendorFree\Monolog\Logger $logger, \WDFQVendorFree\Monolog\Handler\HandlerInterface $handler) : void
    {
        if (\is_string($this->options['action_level'])) {
            $handler = new \WDFQVendorFree\Monolog\Handler\FingersCrossedHandler($handler, $this->options['action_level']);
        }
        // Purposefully replace all existing handlers.
        $logger->setHandlers([$handler]);
    }
}
