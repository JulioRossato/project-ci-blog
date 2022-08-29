<?php

function getSeo($SEO = null)
{
    $return = '';

    if (is_array($SEO)):
        foreach (array_filter($SEO) as $k => $v):
            switch ($k):
                case "canonical":
                    $return .= '<link rel="canonical" href="'.$v.'"/>'."\n";
                    $return .= '<meta name="og:url" content="'.$v.'"/>'."\n";
                    break;
                case "title":
                    $return .= '<meta name="og:title" content="'.$v.'"/>'."\n";
                    $return .= '<meta name="twitter:title" content="'.$v.'"/>'."\n";
                    break;
                case "description":
                    $return .= '<meta name="description" content="'.$v.'"/>'."\n";
                    $return .= '<meta property="og:description" content="'.$v.'"/>'."\n";
                    $return .= '<meta property="twitter:description" content="'.$v.'"/>'."\n";
                    break;
                case "image":
                    $return .= '<meta property="og:image" content="'.$v.'"/>'."\n";
                    $return .= '<meta property="twitter:image" content="'.$v.'"/>'."\n";
                    break;
                case "author":
                    $return .= '<meta name="author" content="'.$v.'"/>'."\n";
                    $return .= '<meta property="article:author" content="'.$v.'"/>'."\n";
                    break;
                case "type":
                    if ($v == 'video'):
                        $return .= '<meta name="og:type" content="video.movie"/>'."\n";
                    elseif ($v == "gallery"):
                        $return .= '<meta name="og:type" content="video.movie"/>'."\n";
                    elseif ($v == "post"):
                        $return .= '<meta name="og:type" content="article"/>'."\n";
                    else:
                        $return .= '<meta name="og:type" content="website"/>'."\n";
                    endif;
                    break;
                default :
                    $return .= '';
                    break;
            endswitch;
        endforeach;
    endif;

    return $return;
}
