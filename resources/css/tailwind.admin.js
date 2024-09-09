export default {
    presets: [require("../../vendor/filament/filament/tailwind.config.preset")],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php",
        "./vendor/awcodes/filament-curator/resources/**/*.blade.php",
        './vendor/pboivin/filament-peek/resources/**/*.blade.php'
    ],
};
