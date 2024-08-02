<?php

namespace Theme;

class Fuwafuwa extends \Theme {
    /**
     * Print menu
     *
     * @param array|null $menu 
     * @param int $level 
     *
     * @return array
     */
    function decor(?array $menu, int $level): array {
        $f3 = \Base::instance();
        $menu['base'] = $f3['BASE'];
        $menu['url'] = $menu['url'] ? "$menu[base]/$menu[url]" : '#';

        if (empty($menu['submenu'])) {
            $icon = isset($menu['options']['icon']) ? '<svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 stroke-1 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white fill-transparent stroke-gray-500 dark:stroke-gray-400">
        <use href="#' . $menu['options']['icon'] . '" />
    </svg>' : '<div class="size-6"></div>';
            $decor = [
                'menu' => [
                    'prefix' => \Preview::instance()->resolve('<a href="{{@url}}"
                class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                ' . $icon .
                        '<span class="ml-3" sidebar-toggle-item="">{{@title}}', $menu),
                    'suffix' => '</span></a>',
                ]
            ];
        } else {
            $icon = isset($menu['options']['icon']) ? '<svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 stroke-1 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white fill-transparent stroke-gray-500 dark:stroke-gray-400"
            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true">
        <use href="#' . $menu['options']['icon'] . '" />
    </svg>' : '<div class="size-6"></div>';
            $decor = [
                'menu' => [
                    'prefix' => \Preview::instance()->resolve('<li x-data="{ submenuOpen: false }">
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                        x-on:click.away="submenuOpen = false" x-on:click="submenuOpen = !submenuOpen">
                        ' . $icon . '
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{@title}}</span>
                        <svg class="size-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul class="py-2 space-y-2 bg-gray-50" x-show="submenuOpen">', $menu),
                    'suffix' => '</ul>'
                ],

            ];
        }
        return $decor;
    }

    /**
     * printSubMenu
     *
     * @param array $menu
     * @param int $level
     * @param string $group
     * @return string
     */
    function printSubmenu(array $menu, int $level, ?string $group): string {
        $f3 = \Base::instance();
        $spacer = str_repeat("  ", $level);

        $result = "";
        foreach ($menu as $sm) {
            if (!empty($sm['enabled'])) {
                $decor = $this->decor($sm, $level);
                $result .= $spacer . $decor['menu']['prefix'];
                if (isset($sm['submenu'])) {
                    $result .= $spacer . ($decor['sub']['prefix'] ?? "");
                    $result .= $this->printSubmenu($sm['submenu'], $level + 1, $group);
                    $result .= $spacer . ($decor['sub']['suffix'] ?? "");
                }
                $result .= $spacer . $decor['menu']['suffix'];
            }
        }
        return $result;
    }

    function printSubMobileMenu(array $menu, int $level, ?string $group): string {
        return $this->printSubmenu($menu, $level, $group, true);
    }
}
