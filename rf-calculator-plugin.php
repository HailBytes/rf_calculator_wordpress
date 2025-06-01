<?php
/**
 * Plugin Name: RF Frequency to Wavelength Calculator
 * Plugin URI: https://hailbytes.com
 * Description: A calculator that converts RF frequencies to wavelengths using the speed of light. Use shortcode [rf_calculator] to display.
 * Version: 1.0.4
 * Author: David McHale (HailBytes Software)
 * Author URI: https://hailbytes.com
 * License: MPL v2 or later
 * License URI: https://www.mozilla.org/en-US/MPL/2.0/
 * Text Domain: rf-calculator
 * Domain Path: /languages
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('RF_CALCULATOR_PLUGIN_URL', plugin_dir_url(__FILE__));
define('RF_CALCULATOR_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('RF_CALCULATOR_VERSION', '1.0.2');

class RFCalculatorPlugin {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }
    
    public function init() {
        // Register shortcode
        add_shortcode('rf_calculator', array($this, 'render_calculator'));
        
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        
        // Handle AJAX requests
        add_action('wp_ajax_calculate_wavelength', array($this, 'ajax_calculate_wavelength'));
        add_action('wp_ajax_nopriv_calculate_wavelength', array($this, 'ajax_calculate_wavelength'));
    }
    
    public function activate() {
        // Plugin activation tasks (if any)
        flush_rewrite_rules();
    }
    
    public function deactivate() {
        // Plugin deactivation tasks (if any)
        flush_rewrite_rules();
    }
    
    public function enqueue_assets() {
        wp_enqueue_script('jquery');
        
        // Enqueue CSS
        wp_enqueue_style(
            'rf-calculator-css', 
            RF_CALCULATOR_PLUGIN_URL . 'assets/css/rf-calculator.css', 
            array(), 
            RF_CALCULATOR_VERSION
        );
        
        // Enqueue JavaScript
        wp_enqueue_script(
            'rf-calculator-js', 
            RF_CALCULATOR_PLUGIN_URL . 'assets/js/rf-calculator.js', 
            array('jquery'), 
            RF_CALCULATOR_VERSION, 
            true
        );
        
        // Localize script for AJAX
        wp_localize_script('rf-calculator-js', 'rf_calculator_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('rf_calculator_nonce')
        ));
    }
    
    public function render_calculator($atts) {
        $atts = shortcode_atts(array(
            'title' => 'Frequency to Wavelength Calculator'
        ), $atts);
        
        ob_start();
        ?>
        <div id="rf-calculator-container">
            <div class="rf-calculator-wrapper">
                <h3 class="rf-calculator-title"><?php echo esc_html($atts['title']); ?></h3>
                <p class="rf-calculator-description">
                    This frequency to wavelength calculator helps you determine the wavelength of a waveform based 
                    on the frequency. It assumes that the wave is traveling at the speed of light which is the case for 
                    most wireless signals. The entry unit of frequency can be modified, the output wavelength is 
                    calculated in meters.
                </p>
                
                <div class="rf-calculator-form">
                    <h4>Enter the Frequency to Calculate the Wavelength</h4>
                    
                    <div class="rf-input-section">
                        <div class="rf-input-group">
                            <input type="number" id="rf-frequency-input" placeholder="100" step="any" min="0">
                            <select id="rf-frequency-unit">
                                <option value="Hz">Hz</option>
                                <option value="kHz" selected>kHz</option>
                                <option value="MHz">MHz</option>
                                <option value="GHz">GHz</option>
                            </select>
                        </div>
                        
                        <div class="rf-button-group">
                            <button type="button" id="rf-calculate-btn" class="rf-btn rf-btn-primary">Calculate</button>
                            <button type="button" id="rf-reset-btn" class="rf-btn rf-btn-secondary">Reset</button>
                        </div>
                    </div>
                    
                    <div id="rf-result-section" class="rf-result-section" style="display: none;">
                        <h4>Result</h4>
                        <div class="rf-result-item">
                            <label>Wavelength</label>
                            <div class="rf-result-value">
                                <span id="rf-wavelength-value">0</span>
                                <span class="rf-unit">m</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="rf-formula-section">
                    <h4>Formula for Frequency to Wavelength Calculator</h4>
                    <div class="rf-formula-content">
                        <div class="rf-formula-text">
                            <p><strong>λ = c / f</strong></p>
                            <p>Where:</p>
                            <ul>
                                <li><strong>λ (lambda)</strong> = Wavelength in meters</li>
                                <li><strong>c</strong> = Speed of light (299,792,458 m/s)</li>
                                <li><strong>f</strong> = Frequency in Hz</li>
                            </ul>
                        </div>
                        
                        <div class="rf-wave-diagram">
                            <svg width="300" height="120" viewBox="0 0 300 120">
                                <defs>
                                    <style>
                                        .wave-line { stroke: #333; stroke-width: 2; fill: none; }
                                        .wave-text { font-family: Arial, sans-serif; font-size: 12px; fill: #333; }
                                        .wave-arrow { stroke: #666; stroke-width: 1; fill: none; marker-end: url(#arrowhead); }
                                        .wave-bracket { stroke: #666; stroke-width: 1; fill: none; }
                                    </style>
                                    <marker id="arrowhead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orient="auto">
                                        <polygon points="0 0, 10 3.5, 0 7" fill="#666" />
                                    </marker>
                                </defs>
                                
                                <!-- Wave -->
                                <path d="M 20 60 Q 40 30, 60 60 T 100 60 T 140 60 T 180 60 T 220 60 T 260 60" class="wave-line"/>
                                
                                <!-- Wavelength brackets -->
                                <path d="M 20 80 L 20 85 M 20 82.5 L 140 82.5 M 140 80 L 140 85" class="wave-bracket"/>
                                <text x="80" y="95" text-anchor="middle" class="wave-text">Wavelength (λ)</text>
                                
                                <!-- Amplitude line -->
                                <path d="M 5 60 L 10 60" class="wave-bracket"/>
                                <path d="M 7.5 30 L 7.5 60" class="wave-bracket"/>
                                <text x="2" y="45" text-anchor="middle" class="wave-text" transform="rotate(-90 2 45)">Amplitude</text>
                                
                                <!-- Labels -->
                                <text x="60" y="25" text-anchor="middle" class="wave-text">Crest (ridge)</text>
                                <text x="220" y="105" text-anchor="middle" class="wave-text">Trough</text>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    public function ajax_calculate_wavelength() {
        // Verify nonce
        if (!wp_verify_nonce($_POST['nonce'], 'rf_calculator_nonce')) {
            wp_die('Security check failed');
        }
        
        $frequency = floatval($_POST['frequency']);
        $unit = sanitize_text_field($_POST['unit']);
        
        if ($frequency <= 0) {
            wp_send_json_error('Please enter a valid frequency greater than 0');
            return;
        }
        
        // Convert frequency to Hz
        $frequency_hz = $this->convert_to_hz($frequency, $unit);
        
        // Calculate wavelength using speed of light (299,792,458 m/s)
        $speed_of_light = 299792458;
        $wavelength = $speed_of_light / $frequency_hz;
        
        wp_send_json_success(array(
            'wavelength' => number_format($wavelength, 6),
            'frequency_hz' => $frequency_hz
        ));
    }
    
    private function convert_to_hz($frequency, $unit) {
        switch ($unit) {
            case 'Hz':
                return $frequency;
            case 'kHz':
                return $frequency * 1000;
            case 'MHz':
                return $frequency * 1000000;
            case 'GHz':
                return $frequency * 1000000000;
            default:
                return $frequency;
        }
    }
}

// Initialize the plugin
new RFCalculatorPlugin();
?>