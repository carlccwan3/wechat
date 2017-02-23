<?php
require_once dirname(__FILE__) . '/../common/Common.php';
require_once dirname(__FILE__) . '/../conf/OutDefine.php';
require_once dirname(__FILE__) . '/../common/jssdk.php';
class GetWeixinSignature extends AbstractInterface
{
    public function initialize()
    {
        return true;
    }

    public function verifyInput(&$args)
    {
        $req = $args['interface']['para'];

        $rules = array(
            'url' => array('type' => 'string'),
        );

        return $this->_verifyInput($args, $rules);
    }

    public function process()
    {
        interface_log(INFO, EC_OK,"GetWeixinSignature args=" . var_export($this->_args, true));

        $config = getConf('ROUTE.WEIXIN');
        $url = $this->_args['url'];
        $jssdk = new JSSDK($config['APPID'], $config['APPSECRET']);
        $wxconfig = $jssdk->getSignPackage($url);
        $this->_retValue = EC_OK;
        $this->_data=array("data" => $wxconfig);
        interface_log(INFO, EC_OK, 'GetWeixinSignature::process() succeed');
        return true;
    }
}
?>
