<?php
 
class settings
{

    // if(variable_get('autocaptime') == '') variable_set('autocaptime', 0);
    // if(variable_get('cko_integration') != 'hosted') variable_set('paymentMode', 'cards');
  
    public $privateKey         = '';
    public $publicKey          = '';
    public $webhookKey         = '';
    public $endpointMode       = 'live';
    public $debugMode          = FALSE;
    public $transactionMethod  = '';
    public $autocaptime        = 0;
    public $paymentMode        = 'mixed';   
    public $is3D               = FALSE;
    public $gatewayTimeout     = 0;
    public $logoUrl            = '';
    public $themeColor         = '';
    public $title              = '';
    public $subtitle           = '';
    public $buttonLabel        = '';
    public $currencyCode       = 'false';
    public $language           = '';
    public $integrationMethod  = 'hosted';
    public $lightboxRenderMode = 0;
  
    public function __construct()
    {
        $this->privateKey         = variable_get('cko_private_key');
        $this->publicKey          = variable_get('cko_public_key');
        $this->webhookKey         = variable_get('cko_webhook_key');
        $this->endpointMode       = variable_get('cko_endpoint_mode');
        $this->debugMode          = variable_get('cko_debug_mode');
        $this->transactionMethod  = variable_get('cko_transaction_method');
        $this->autocaptime        = variable_get('cko_autocaptime');
        $this->paymentMode        = variable_get('cko_payment_mode');   
        $this->is3D               = variable_get('cko_is3D');
        $this->gatewayTimeout     = variable_get('cko_gateway_timeout');
        $this->logoUrl            = variable_get('cko_logo_url');
        $this->themeColor         = variable_get('cko_theme_color');
        $this->title              = variable_get('cko_title', variable_get('site_name', "Default site name"));
        $this->subtitle           = variable_get('cko_subtitle');
        $this->buttonLabel        = variable_get('cko_button_label');
        $this->currencyCode       = variable_get('cko_currency_code');
        $this->language           = variable_get('cko_language');
        $this->integrationMethod  = variable_get('cko_integration_method');
        $this->lightboxRenderMode = variable_get('cko_render_mode');
    }
}
 
?>