@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage()=='This action is unauthorized.' ? '권한이 없습니다(로그인 등을 확인해 주십시오)': ($exception->getMessage() ?: 'Forbidden')))
