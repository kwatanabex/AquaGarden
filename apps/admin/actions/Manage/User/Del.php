<?php
SyL_Loader::fw('Adm.Flow.Del');

/**
 * {FORM_CLASS_NAME}フォーム削除クラス
 *
 * @access    public
 * @package   {PROJECT_NAME}
 * @author    {author}
 * @version   $Id:$
 */
class Manage_User_Del extends SyL_AdmFlowDel
{
    /**
     * アクションフォームクラス名
     *
     * @access protected
     * @var string
     */
    var $classname = 'EuryL.Form.User';
}
