<?php
class MesExtensions extends Twig\Extension\AbstractExtension {

    public function getFilters() {
        return [
            new Twig\TwigFilter('markdown', [$this, 'markdownParse'])
        ];
    }


    public function markdownParse($value) {

        // return \Michelf\MarkdownEtra::defaultTransform($value);
    }

}