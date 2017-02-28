<?php
require_once 'Lst.php';
/**
 * AdmFormsEl_menuフォーム一覧表示へフォワードするクラス
 *
 * @access    public
 * @package   AquaGarden
 * @author    {author}
 * @version   $Id:$
 */
class Menu_Index extends Menu_Lst
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
        $router->setTemplateFile('Menu/Lst.html');
    }
}
