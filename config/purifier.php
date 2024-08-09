<?php
/**
 * Ok, glad you are here
 * first we get a config instance, and set the settings
 * $config = HTMLPurifier_Config::createDefault();
 * $config->set('Core.Encoding', $this->config->get('purifier.encoding'));
 * $config->set('Cache.SerializerPath', $this->config->get('purifier.cachePath'));
 * if ( ! $this->config->get('purifier.finalize')) {
 *     $config->autoFinalize = false;
 * }
 * $config->loadArray($this->getConfig());
 *
 * You must NOT delete the default settings
 * anything in settings should be compacted with params that needed to instance HTMLPurifier_Config.
 *
 * @link http://htmlpurifier.org/live/configdoc/plain.html
 */

return [
    'encoding'           => 'UTF-8',
    'finalize'           => true,
    'ignoreNonStrings'   => false,
    'cachePath'          => storage_path('app/purifier'),
    'cacheFileMode'      => 0755,
    'settings'      => [
        'default' => [
            'HTML.Doctype'             => 'HTML 4.01 Transitional',
            // 'HTML.Allowed'             => 'div,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
            // 'HTML.Allowed'             => 'a[href|title|style],abbr[title|style],address[title|style],article[title|style],aside[title|style],b[title|style],bdi[title|style],bdo[dir|title|style],blockquote[cite|title|style],br[style],caption[title|style],cite[title|style],code[title|style],col[span|title|style],colgroup[span|title|style],data[value|title|style],dd[title|style],del[cite|datetime|title|style],details[open|title|style],dfn[title|style],dialog[open|title|style],div[title|style],dl[title|style],dt[title|style],em[title|style],figcaption[title|style],figure[title|style],h1[title|style],h2[title|style],h3[title|style],h4[title|style],h5[title|style],h6[title|style],header[title|style],hgroup[title|style],hr[title|style],i[title|style],img[src|alt|width|height|title|style],ins[cite|datetime|title|style],kbd[title|style],li[title|style],main[title|style],mark[title|style],menu[title|style],ol[reversed|start|type|title|style],p[title|style],pre[title|style],q[cite|title|style],rp[title|style],rt[title|style],ruby[title|style],s[title|style],samp[title|style],section[title|style],small[title|style],span[title|style],strong[title|style],sub[title|style],summary[title|style],sup[title|style],table[title|style],tbody[title|style],td[colspan|rowspan|title|style],tfoot[title|style],th[abbr|colspan|rowspan|title|style],thead[title|style],time[datetime|title|style],tr[title|style],u[title|style],ul[title|style],var[title|style],wbr[title|style]',
            'HTML.Allowed'             => 'a[href|title|style|class],abbr[title|style|class],address[title|style|class],article[title|style|class],aside[title|style|class],b[title|style|class],bdo[dir|title|style|class],blockquote[cite|title|style|class],br[style],caption[title|style|class],cite[title|style|class],code[title|style|class],col[span|title|style|class],colgroup[span|title|style|class],dd[title|style|class],del[cite|datetime|title|style|class],dfn[title|style|class],div[title|style|class],dl[title|style|class],dt[title|style|class],em[title|style|class],figcaption[title|style|class],figure[title|style|class],h1[title|style|class],h2[title|style|class],h3[title|style|class],h4[title|style|class],h5[title|style|class],h6[title|style|class],header[title|style|class],hgroup[title|style|class],hr[title|style|class],i[title|style|class],img[src|alt|width|height|title|style|class],ins[cite|datetime|title|style|class],kbd[title|style|class],li[title|style|class],mark[title|style|class],menu[title|style|class],ol[start|type|title|style|class],p[title|style|class],pre[title|style|class],q[cite|title|style|class],s[title|style|class],samp[title|style|class],section[title|style|class],small[title|style|class],span[title|style|class],strong[title|style|class],sub[title|style|class],sup[title|style|class],table[title|style|class],tbody[title|style|class],td[colspan|rowspan|title|style|class],tfoot[title|style|class],th[abbr|colspan|rowspan|title|style|class],thead[title|style|class],tr[title|style|class],u[title|style|class],ul[title|style|class],var[title|style|class],wbr[title|style|class]',
            // 'CSS.AllowedProperties'    => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            // 'CSS.AllowedProperties'    => 'color,font-family,font-size,font-weight,text-decoration,background,margin,padding,border,border-image,text-align,width,height,list-style-type,display',
            'CSS.AllowedProperties' => null,
            // added
            'CSS.Trusted' => true,
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty'   => true,
        ],
        'test'    => [
            'Attr.EnableID' => 'true',
        ],
        "youtube" => [
            "HTML.SafeIframe"      => 'true',
            "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%",
        ],
        'custom_definition' => [
            'id'  => 'html5-definitions',
            'rev' => 1,
            'debug' => false,
            'elements' => [
                // http://developers.whatwg.org/sections.html
                ['section', 'Block', 'Flow', 'Common'],
                ['nav',     'Block', 'Flow', 'Common'],
                ['article', 'Block', 'Flow', 'Common'],
                ['aside',   'Block', 'Flow', 'Common'],
                ['header',  'Block', 'Flow', 'Common'],
                ['footer',  'Block', 'Flow', 'Common'],
				
				// Content model actually excludes several tags, not modelled here
                ['address', 'Block', 'Flow', 'Common'],
                ['hgroup', 'Block', 'Required: h1 | h2 | h3 | h4 | h5 | h6', 'Common'],
				
				// http://developers.whatwg.org/grouping-content.html
                ['figure', 'Block', 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow', 'Common'],
                ['figcaption', 'Inline', 'Flow', 'Common'],
				
				// http://developers.whatwg.org/the-video-element.html#the-video-element
                ['video', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common', [
                    'src' => 'URI',
					'type' => 'Text',
					'width' => 'Length',
					'height' => 'Length',
					'poster' => 'URI',
					'preload' => 'Enum#auto,metadata,none',
					'controls' => 'Bool',
                ]],
                ['source', 'Block', 'Flow', 'Common', [
					'src' => 'URI',
					'type' => 'Text',
                ]],

				// http://developers.whatwg.org/text-level-semantics.html
                ['s',    'Inline', 'Inline', 'Common'],
                ['var',  'Inline', 'Inline', 'Common'],
                ['sub',  'Inline', 'Inline', 'Common'],
                ['sup',  'Inline', 'Inline', 'Common'],
                ['mark', 'Inline', 'Inline', 'Common'],
                ['wbr',  'Inline', 'Empty', 'Core'],
				
				// http://developers.whatwg.org/edits.html
                ['ins', 'Block', 'Flow', 'Common', ['cite' => 'URI', 'datetime' => 'CDATA']],
                ['del', 'Block', 'Flow', 'Common', ['cite' => 'URI', 'datetime' => 'CDATA']],
            ],
            'attributes' => [
                ['iframe', 'allowfullscreen', 'Bool'],
                ['table', 'height', 'Text'],
                ['td', 'border', 'Text'],
                ['th', 'border', 'Text'],
                ['tr', 'width', 'Text'],
                ['tr', 'height', 'Text'],
                ['tr', 'border', 'Text'],
            ],
        ],
        'custom_attributes' => [
            ['a', 'target', 'Enum#_blank,_self,_target,_top'],
        ],
        'custom_elements' => [
            ['u', 'Inline', 'Inline', 'Common'],
        ],
    ],

];
