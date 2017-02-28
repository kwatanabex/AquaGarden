<?php
SyL_Loader::fw('Adm.Flow.Lst');

/**
 * {FORM_CLASS_NAME}フォーム一覧表示クラス
 *
 * @access    public
 * @package   {PROJECT_NAME}
 * @author    {author}
 * @version   $Id:$
 */
class Manage_User_Lst extends SyL_AdmFlowLst
{
    /**
     * アクションフォームクラス名
     *
     * @access protected
     * @var string
     */
    var $classname = 'EuryL.Form.User';
}
