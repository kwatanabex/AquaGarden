<?php
require_once 'Lst.php';
/**
 * {FORM_CLASS_NAME}フォーム一覧表示へフォワードするクラス
 *
 * @access    public
 * @package   {PROJECT_NAME}
 * @author    {author}
 * @version   $Id:$
 */
class Manage_User_Index extends Manage_User_Lst
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
        $router->setTemplateFile('Manage/User/Lst.html');
    }
}
