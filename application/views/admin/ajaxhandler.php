<?php

if(Input::get('type')=="comment")
{
    $com = Comment::find(Input::get('id'));
    $com->approved = Input::get('approved');
    $com->save();
}
elseif(Input::get('type')=="deletecomment")
{
    $com = Comment::find(Input::get('id'));
    $com->delete();
}