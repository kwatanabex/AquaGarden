<?php
error_reporting(E_ALL);

/**
 * ���������ȥ���ȥ��饯�饹���ɤ߹���
 */
require_once '/usr/local/apache2/data/SyL/SyL.php';

/**
 * ��ư�ѥ�᡼��������
 *
 *  project_dir - �ץ������ȥǥ��쥯�ȥ�
 *  app_name    - ���ץꥱ�������̾
 *  action_key  - ���������ѥ�᡼���Υ���̾
 *  cache       - ����å��������ˡ�ʢ�̤���Ϥǥ���å������Ѥ��ʤ���
 */
$config = array(
  'project_dir'  => '/usr/local/apache2/data/projects/AquaGarden',
  'app_name'     => 'admin',
  'action_key'   => 'action',
  'cache'        => 'file'
);

/**
 * �ե졼������ư
 */
SyL_Controller::streaming($config);

?>
