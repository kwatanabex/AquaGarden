<?php
SyL_Loader::fw('Adm.Flow.New');

/**
 * AdmFormsEl_userフォーム新規作成クラス
 *
 * @access    public
 * @package   AquaGarden
 * @author    {author}
 * @version   $Id:$
 */
class User_New extends SyL_AdmFlowNew
{
    /**
     * アクションフォームクラス名
     *
     * @access protected
     * @var string
     */
    var $classname = 'Adm.Forms.El_user';

    /**
     * デフォルトアクション処理
     *
     * @access public
     * @param object データ管理オブジェクト
     * @param object コンテキスト管理オブジェクト
     */
    function execute(&$data, &$context)
    {
        parent::execute($data, $context);
    }
}
