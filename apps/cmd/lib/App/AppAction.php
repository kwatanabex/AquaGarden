<?php
/**
 * ���ץꥱ��������̥�������󥯥饹
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
     * ���������᥽�åɼ¹����˼¹Ԥ����᥽�å�
     *
     * @access public
     * @param object �ǡ����������֥�������
     * @param object ����ƥ����ȥ��֥�������
     */
    function preExecute(&$data, &$context)
    {
        parent::preExecute($data, $context);
    }

    /**
     * ���������᥽�åɼ¹����˼¹Ԥ���븡�ڥ᥽�å�
     * 
     * @access public
     * @param object �ǡ����������֥�������
     * @param object ����ƥ����ȥ��֥�������
     */
    function validate(&$data, &$context)
    {
        parent::validate($data, $context);
    }

    /**
     * ���������᥽�åɼ¹Ը�˼¹Ԥ����᥽�å�
     * 
     * @access public
     * @param object �ǡ����������֥�������
     * @param object ����ƥ����ȥ��֥�������
     */
    function postExecute(&$data, &$context)
    {
        parent::postExecute($data, $context);
    }
}

?>
