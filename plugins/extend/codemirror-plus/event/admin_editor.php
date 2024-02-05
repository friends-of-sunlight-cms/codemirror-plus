<?php

use Sunlight\Core;
use Sunlight\User;

return function (array $args) {
    global $_admin;

    // if the system Codemirror is active, then this plugin will not be activated.
    if (Core::$pluginManager->getPlugins()->hasExtend('codemirror')) {
        return;
    }

    if (
        // format is supported
        isset($this->getExtraOption('supported_formats')[$args['options']['format']])

        // and should use a code editor and not a wysiwyg editor
        && (
            $args['options']['mode'] === 'code'
            || !$_admin->wysiwygAvailable
            || !User::isLoggedIn()
            || !User::$data['wysiwyg']
        )
    ) {
        $this->enableEventGroup('codemirror');
    }
};
