<?php if (!defined('APPLICATION')) exit();
/*
Copyright 2008, 2009 Vanilla Forums Inc.
This file is part of Garden.
Garden is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
Garden is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with Garden.  If not, see <http://www.gnu.org/licenses/>.
Contact Vanilla Forums Inc. at support [at] vanillaforums [dot] com
*/

$LocaleInfo['russian'] = array( // make sure the key of this array is the same as its folder name.
   'Locale'       => 'ru-RU',
   'Name'         => '������� ����',
   'Description'  => '',
   'Version'      => '0.1 beta',
   'Author'       => 'Turbof.ru',
   'AuthorEmail'  => '',
   'AuthorUrl'    => '',
   'License'      => ''
);



$Definition['Discussions'] = '����';
$Definition['Inbox'] = '���������';
$Definition['Mark All Viewed'] = '.';
$Definition['All Discussions'] = '��� ����';
$Definition['My Discussions'] = '��� ����';
$Definition['My Bookmarks'] = '��������� ����';
$Definition['No discussions were found.'] = '������ �� �������!';

$Definition['Sign In'] = '�����';
$Definition['Email/Username'] = '�����';
$Definition['Password'] = '������';
$Definition['Forgot?'] = '��������� ������';
$Definition['Keep me signed in'] = '��������� ���� �� �����';
$Definition['Enter your email address or username'] = '������� ���� ����� ��� email';
$Definition['Request a new password'] = '������� ����� ������';


$Definition['Quote'] = '��������';



/*extra Theme funcion*/
function Gdn_DateF($date, &$class_name)
{
    if(is_numeric($date)) $tmp = $date;
    else
    {
        $tmp = strtotime($date);
        if(!is_numeric($tmp) && $tmp < 1) $tmp = $date;
    }
    
    $Session = Gdn::Session();
    if($Session->UserID > 0) $tmp += $Session->User->HourOffset * 3600;

    $yesterday = strtotime('yesterday'); 
    $today = strtotime('today');
    $nextday = $today + 86400;

    if($tmp < $yesterday || $tmp >= $nextday)
    {    
        static $_month_rus_1 = array(
            1 => '������',
            2 => '�������',
            3 => '�����',
            4 => '������',
            5 => '���',
            6 => '����',
            7 => '����',
            8 => '�������',
            9 => '��������',
            10 => '�������',
            11 => '������',
            12 => '�������',
        );
        $now_ts = time();        
        if(date('y', $tmp) == date('y', $now_ts)) return date('j '.$_month_rus_1[date('n', $tmp)], $tmp); //���� � ������� ���� => 15 ������
        else return date('j '.$_month_rus_1[date('n', $tmp)].' Y �.', $tmp); //����� 15 ������ 2006 �.
        
        //return date($mask, $tmp);
    }
    elseif($tmp >= $yesterday && $tmp < $today) {$class_name = 'yestarday';return date('����� H:i', $tmp);}
    elseif($tmp >= $today && $tmp < $nextday) {$class_name = 'today';return date('������� H:i', $tmp);}
    else return '';
}


function Gdn_Plural($num, $h1, $h2, $h3)
{
    if(($num % 10 == 1) && ($num % 100 != 11)) return $h1;
    else
    {
        if(($num % 10 >= 2) && ($num % 10 <= 4)&&(($num % 100 < 10)||($num % 100 >= 20))) return $h2;
        else
            return $h3;
    }
}