<?php

function activity_log($type, $action, $items, $assign_to, $assign_type)
{
    $CI = &get_instance();

    $param['name'] = $CI->session->userdata('name');
    $param['type'] = $type; //asset, asesoris, komponen, inventori
    $param['action'] = $action; //membuat, menambah, menghapus, mengubah,
    $param['items'] = $items; //nama item
    $param['assign_to'] = $assign_to; //target
    $param['assign_type'] = $assign_type; //target

    //load model log
    $CI->load->model('log_model', 'log');

    //save to database
    $CI->log->save_log($param);
}
