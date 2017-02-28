<?php
SyL_Loader::fw('Adm.Flow.Upd');

/**
 * {FORM_CLASS_NAME}フォーム更新クラス
 *
 * @access    public
 * @package   {PROJECT_NAME}
 * @author    {author}
 * @version   $Id:$
 */
class Manage_User_Upd extends SyL_AdmFlowUpd
{
    /**
     * アクションフォームクラス名
     *
     * @access protected
     * @var string
     */
    var $classname = 'EuryL.Form.User';
}
