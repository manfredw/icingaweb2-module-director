<?php

namespace Icinga\Module\Director\Web\ActionBar;

use gipfl\IcingaWeb2\Link;

class TemplateActionBar extends DirectorBaseActionBar
{
    protected function assemble()
    {
        $type = str_replace('_', '-', $this->type);
        $plType = preg_replace('/cys$/', 'cies', $type . 's');
        $renderTree = $this->url->getParam('render') === 'tree';
        $renderParams = $renderTree ? null : ['render' => 'tree'];
        $this->add(
            $this->getBackToDashboardLink()
        )->add(
            Link::create(
                $this->translate('Add'),
                "director/$type/add",
                ['type' => 'template'],
                [
                    'title' => $this->translate('Create a new Template'),
                    'class' => 'icon-plus',
                    'data-base-target' => '_next'
                ]
            )
        )->add(
            Link::create(
                $renderTree ? $this->translate('Table') : $this->translate('Tree'),
                "director/$plType/templates",
                $renderParams,
                [
                    'class' => 'icon-' . ($renderTree ? 'doc-text' : 'sitemap'),
                    'title' => $renderTree
                        ? $this->translate('Switch to Tree view')
                        : $this->translate('Switch to Table view')
                ]
            )
        );
    }
}
