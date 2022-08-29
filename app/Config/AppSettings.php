<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class AppSettings extends BaseConfig
{
    public $siteName     = SITE_TITLE;
    public $siteAuthor   = SITE_AUTHOR;
    public $siteEmail    = SITE_EMAIL;
    public $fileType     = array(
        'image'       => array(
            'types' => array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'eps'),
            'icon'  => ''
        ),
        'video'       => array(
            'types' => array('mp4', '3gp', 'avchd', 'avi', 'flv', 'mkv', 'mov', 'webm',
                'wmv', 'mpg', 'mpeg', 'ogg'),
            'icon'  => '/assets/Admin/img/video-file.png'
        ),
        'document'    => array(
            'types' => array('doc', 'docx', 'txt', 'pdf', 'ppt', 'pptx'),
            'icon'  => '/assets/Admin/img/doc-file.png'
        ),
        'spreadsheet' => array(
            'types' => array('xls', 'xsls'),
            'icon'  => '/assets/Admin/img/xls-file.png'
        ),
        'archive'     => array(
            'types' => array('zip', '7z', 'bz2', 'gz', 'gzip', 'rar', 'tar'),
            'icon'  => '/assets/Admin/img/zip-file.png'
        )
    );
    public $filesAllowed = array(
        'image'       => [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'bmp',
            'eps',
            'webp'
        ],
        'video'       => [
            'mp4',
            '3gp',
            'avchd',
            'avi',
            'flv',
            'mkv',
            'mov',
            'webm',
            'wmv',
            'mpg',
            'mpeg',
            'ogg'
        ],
        'document'    => [
            'doc',
            'docx',
            'txt',
            'pdf',
            'ppt',
            'pptx'
        ],
        'spreadsheet' => [
            'xls',
            'xsls'
        ],
        'archive'     => [
            'zip',
            '7z',
            'bz2',
            'gz',
            'gzip',
            'rar',
            'tar'
        ],
    );

}