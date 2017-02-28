<?php
/**
 * アプリケーション共通アクションクラス
 *
 * @access    public
 * @package   {{APP_NAME}}
 * @author    {author}
 * @copyright {copyright}
 * @version   $Id:$
 */
class AppAction extends SyL_Action
{
    /**
     * アクションメソッド実行前に実行されるメソッド
     *
     * @access public
     * @param object データ管理オブジェクト
     * @param object コンテキストオブジェクト
     */
    function preExecute(&$data, &$context)
    {
        parent::preExecute($data, $context);
    }

    /**
     * アクションメソッド実行前に実行される検証メソッド
     * 
     * @access public
     * @param object データ管理オブジェクト
     * @param object コンテキストオブジェクト
     */
    function validate(&$data, &$context)
    {
        parent::validate($data, $context);
    }

    /**
     * アクションメソッド実行後に実行されるメソッド
     * 
     * @access public
     * @param object データ管理オブジェクト
     * @param object コンテキストオブジェクト
     */
    function postExecute(&$data, &$context)
    {
        parent::postExecute($data, $context);
    }
}
