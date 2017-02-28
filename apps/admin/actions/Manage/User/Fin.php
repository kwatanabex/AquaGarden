<?php
SyL_Loader::fw('Adm.Flow.Fin');

/**
 * {FORM_CLASS_NAME}フォーム完了表示クラス
 *
 * @access    public
 * @package   {PROJECT_NAME}
 * @author    {author}
 * @version   $Id:$
 */
class Manage_User_Fin extends SyL_AdmFlowFin
{
    /**
     * アクションフォームクラス名
     *
     * @access protected
     * @var string
     */
    var $classname = 'EuryL.Form.User';
}
