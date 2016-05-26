<?php


class GuanyiApi
{
    private $url = 'http://v2.api.guanyierp.com/rest/erp_open';
    private $appkey = "131130";
    private $sessionkey = "f5b429afcb244dbbbc37f0ca36ea0a84";
    private $secret = "03caf0cffeab49a488ef07bfc3945b8c";

    //==================================================================================================
    //================================ 物料相关  start  =======================================
    public function getProductId($product)
    {
        $productInfo = $this->getProductInfo($product);
        return $productInfo['items'][0]['id'];
    }
    public function getProductInfo($product)
    {
        $url='http://v2.api.guanyierp.com/rest/erp_open';

        $data['appkey'] = $this->appkey;
        $data['sessionkey'] = $this->sessionkey;
        $data['method'] = "gy.erp.items.get";
        $data['code'] = 'XK-'.$product['id'];//商品代码

        $data['sign'] = $this->getSignA($data);

        $json = $this->json_encode_ch($data);

        $info = json_decode($this->https_post($url,$json), true);

        return $info;
    }

    public function uploadProduct($product,$parameters)
    {
        $data = array();

        $data['appkey'] = $this->appkey;
        $data['sessionkey'] = $this->sessionkey;
        $data['method'] = "gy.erp.item.add";

        $data['code'] = 'XK-'.$product['id'];//商品代码
        $panme = str_replace('+','＋',$product['name']);
        $data['name'] = $panme;//商品名称
        $data['simple_name'] = $panme;//商品简称
//        $data['category_code'] = $productType['tid'];//商品类别Code
        $data['supplier_code'] = '';//供应商code
        $data['stock_status_code'] = '';//库存状态code
        $data['weight'] = '';//重量
        $data['unit_code'] = '';//单位code
        $data['sales_point'] = '';//销售积分
        $data['package_point'] = '';//打包积分
        $data['purchase_price'] = '';//标准进价
        $data['sales_price'] = $product['sellprice'];//标准售价
        $data['agent_price'] = '';//代理售价
        $data['cost_price'] = '';//成本价
        $data['supplier_outer_id'] = '';//供应商货号
        $data['note'] = '';//备注

        $data['skus'] = array();
        if(count($parameters)>0){
            for($i = 0 ; $i<count($parameters);$i++){
                $data['skus'][$i] = array();
                $data['skus'][$i]['sku_code'] = $parameters[$i]['pid'] . '-' . $parameters[$i]['id'];
                $data['skus'][$i]['sku_name'] = $parameters[$i]['spec'] . '-' . $parameters[$i]['color'];
                $data['skus'][$i]['sku_weight'] = '';
                $data['skus'][$i]['sku_purchase_price'] = '0';
                $data['skus'][$i]['sku_sales_price'] = $parameters[$i]['sellprice'];
                $data['skus'][$i]['sku_note'] = '';
            }

        }

        $data['sign'] = $this->getSignA($data);
        $json = $this->json_encode_ch($data);
        $info = json_decode($this->https_post($this->url,$json), true);
        return $info;
    }
    public function UpdateMaterial($product)
    {
//        $productType = M('type2product')->where('pid='.$product['id'])->find();
        $parameters = M('product_parameter')->where('pid='.$product['id'])->select();
        $this->UpdateMaterialWithInfos($product,$parameters);
    }

    public function UpdateMaterialWithInfos($product,$parameters)
    {
        $data = array();

        $data['appkey'] = $this->appkey;
        $data['sessionkey'] = $this->sessionkey;
        $data['method'] = "gy.erp.item.update";

        $data['code'] = 'XK-'.$product['id'];//商品代码
        $panme = str_replace('+','＋',$product['name']);
        $data['name'] = $panme;//商品名称
        $data['simple_name'] = $panme;//商品简称
//        $data['category_code'] = $productType['tid'];//商品类别Code
        $data['supplier_code'] = '';//供应商code
        $data['stock_status_code'] = '';//库存状态code
        $data['weight'] = '';//重量
        $data['unit_code'] = '';//单位code
        $data['sales_point'] = '';//销售积分
        $data['package_point'] = '';//打包积分
        $data['purchase_price'] = '';//标准进价
        $data['sales_price'] = $product['sellprice'];//标准售价
        $data['agent_price'] = '';//代理售价
        $data['cost_price'] = '';//成本价
        $data['supplier_outer_id'] = '';//供应商货号
        $data['note'] = '';//备注

        $data['skus'] = array();
        if(count($parameters)>0){
            for($i = 0 ; $i<count($parameters);$i++){
                $data['skus'][$i] = array();
                $data['skus'][$i]['sku_code'] = $parameters[$i]['pid'] . '-' . $parameters[$i]['id'];
                $data['skus'][$i]['sku_name'] = $parameters[$i]['spec'] . '-' . $parameters[$i]['color'];
                $data['skus'][$i]['sku_weight'] = '';
                $data['skus'][$i]['sku_purchase_price'] = '0';
                $data['skus'][$i]['sku_sales_price'] = $parameters[$i]['sellprice'];
                $data['skus'][$i]['sku_note'] = '';
            }

        }

        $data['sign'] = $this->getSignA($data);
        $json = $this->json_encode_ch($data);
        $info = json_decode($this->https_post($this->url,$json), true);
        return $info;
    }

    public function deleteParameter($product,$parameter){
        $data = array();

        $data['appkey'] = $this->appkey;
        $data['sessionkey'] = $this->sessionkey;
        $data['method'] = "gy.erp.item.sku.delete";

        $data['item_id'] = $this->getProductId($product);//商品ID
        $data['code'] = $parameter['pid'] . '-' . $parameter['id']; //规格代码

        $data['sign'] = $this->getSignA($data);
        $json = $this->json_encode_ch($data);
        $info = json_decode($this->https_post($this->url,$json), true);
        return $info;
    }
    //================================ 物料相关 end    =======================================
    //==================================================================================================

    //==================================================================================================
    //================================ 订单相关  start  =======================================
    public function createOrder($order,$items)
    {
        $data = array();

        $data['appkey'] = $this->appkey;
        $data['sessionkey'] = $this->sessionkey;
        $data['method'] = "gy.erp.trade.add";

        $data['shop_code'] = "001";//店铺code
        $data['express_code'] = "YUNDA"; //物流公司code
        $data['warehouse_code'] = "CK001"; //仓库code
        $data['vip_code'] = "001"; //会员code
        $data['platform_code'] = $order["orderid"]; //平台单号

        $data['receiver_name'] = $order["to_name"]; //收货人
        $data['receiver_address'] = $order["to_address"]; //收货地址
//        $data['receiver_zip'] = "001"; //收货邮编
        $data['receiver_mobile'] = $order["to_tel"]; //收货人手机
//        $data['receiver_phone'] = $order["to_address"]; //收货人电话
        $data['receiver_province'] = $order["to_address_1"]; //收货人省份
        $data['receiver_city'] = $order["to_address_2"]; //收货人城市
        $data['receiver_district'] = $order["to_address_3"]; //收货人区域

        $data['deal_datetime'] = $order["createtime"];; //拍单时间
        $data['pay_datetime'] = $order["pay_time"];; //付款时间

        $data['post_fee'] = $order['expenses_money']; //物流费用
//        $data['discount_fee'] = $order['expenses_money']; //让利金额

        $data['invoices'] = array();
        $data['invoices'][0]=array();
        $data['invoices'][0]['invoice_type'] = "1"; //发票类型	 1-普通发票；2-增值发票

        $data['details'] = array();
        for($i=0;$i<count($items);$i++){
            $data['details'][$i]=array();

            $data['details'][$i]['item_code'] = "XK-".$items[$i]['product_id']; //商品代码
            if($items[$i]['parameter_id']>0) {
                $data['details'][$i]['sku_code'] = $items[$i]['product_id'] . "-" . $items[$i]['parameter_id']; //规格代码
            }
            $data['details'][$i]['price'] = $items[$i]['sell_price']; //实际单价
            $data['details'][$i]['qty'] = $items[$i]['number']; //商品数量
            $data['details'][$i]['refund'] = 0; //是否退款
            $data['details'][$i]['note'] = ""; //备注
        }

        $data['payments'] = array();
        $data['payments'][0]=array();
        $data['payments'][0]['pay_type_code'] = "1";//支付类型code
        $data['payments'][0]['payment'] = $order["money"];//支付金额

        $data['sign'] = $this->getSignA($data);
        $json = $this->json_encode_ch($data);
        $info = json_decode($this->https_post($this->url,$json), true);

        $toErpResultData['order_id'] = $order['orderid'];
        $toErpResultData['success'] = $info['success'];
        $toErpResultData['error_code'] = $info['errorCode'];
        $toErpResultData['sub_error_code'] = $info['subErrorCode'];
        $toErpResultData['error_desc'] = $info['errorDesc'];
        $toErpResultData['sub_error_desc'] = $info['subErrorDesc'];
        $toErpResultData['request_method'] = $info['requestMethod'];
        $toErpResultData['info'] = $info;

        M('order_to_erp_log')->add($toErpResultData);


	    $data = array();
	    $data['is_up_to_erp'] = 1;
	    M('order_header')->where(array('id'=>$order['id']))->save($data);

        return $info;
    }

    public function getOrderStatus($order){
        $data = array();

        $data['appkey'] = $this->appkey;
        $data['sessionkey'] = $this->sessionkey;
        $data['method'] = "gy.erp.trade.deliverys.get";

        $data['outer_code'] = $order['orderid']; //平台单号

        $data['sign'] = $this->getSignA($data);
        $json = $this->json_encode_ch($data);
        $info = json_decode($this->https_post($this->url,$json), true);
        return $info;
    }

    //================================ 订单相关 end    =======================================
    //==================================================================================================

    function https_post($url,$post_data=null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'Content-Type:text/json;charset=utf-8',
            'Content-Length:'.strlen($post_data)
        ));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    function getSignA($arr){
        if(empty($arr)){
            return false;
        }
        unset($arr['sign']);
        $arr = $this->json_encode_ch($arr);
        $json = str_ireplace("|\s+|",'',$arr);
        $secret = $this->secret;
        $sign = strtoupper(md5($secret.$json.$secret));
        return $sign;
    }
    function getSignB($json){
        if(empty($json)){
            return false;
        }
        $json = str_ireplace("|\s+|",'',$json);
        $secret = $this->secret;
        $sign = strtoupper(md5($secret.$json.$secret));
        return $sign;
    }

    function json_encode_ch($var){
        return urldecode(json_encode($this->url_encode_arr($var)));
    }
    function url_encode_arr($arr){
        if(is_array($arr)){
            foreach($arr as $k=>$v){
                $arr[$k] = $this->url_encode_arr($v);
            }
        }
        elseif(!is_numeric($arr) && !is_bool($arr))
        {
            $arr = urlencode($arr);
        }
        return $arr;
    }
}

