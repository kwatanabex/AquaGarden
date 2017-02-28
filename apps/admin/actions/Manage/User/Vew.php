<?php
SyL_Loader::fw('Adm.Flow.Vew');

/**
 * {FORM_CLASS_NAME}フォーム詳細表示クラス
 *
 * @access    public
 * @package   {PROJECT_NAME}
 * @author    {author}
 * @version   $Id:$
 */
class Manage_User_Vew extends SyL_AdmFlowVew
{
    /**
     * アクションフォームクラス名
     *
     * @access protected
     * @var string
     */
    var $classname = 'EuryL.Form.User';
}
