<?php
SyL_Loader::fw('Adm.Flow.Lst');

/**
 * AdmFormsEl_user_historyフォーム一覧表示クラス
 *
 * @access    public
 * @package   AquaGarden
 * @author    {author}
 * @version   $Id:$
 */
class User_history_Lst extends SyL_AdmFlowLst
{
    /**
     * アクションフォームクラス名
     *
     * @access protected
     * @var string
     */
    var $classname = 'Adm.Forms.El_user_history';

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
