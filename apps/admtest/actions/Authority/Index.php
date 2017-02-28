<?php
require_once 'Lst.php';
/**
 * AdmFormsEl_authorityフォーム一覧表示へフォワードするクラス
 *
 * @access    public
 * @package   AquaGarden
 * @author    {author}
 * @version   $Id:$
 */
class Authority_Index extends Authority_Lst
{
    /**
     * 通常アクション処理
     *
     * @access public
     * @param object データ管理オブジェクト
     * @param object コンテキスト管理オブジェクト
     * @return void
     */
    function execute(&$data, &$context)
    {
        parent::execute($data, $context);
        $router =& $context->getRouter();
        $router->setTemplateFile('Authority/Lst.html');
    }
}
