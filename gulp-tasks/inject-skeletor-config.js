var fs = require('fs');
var pkg = require('../package.json');

const addTextBetweenTokensInFile = function(text, token, file){
    let fileIn = fs.readFileSync(file, 'utf-8');

    const beginTokenPattern = `(/\\*${token}\\*\\/\\s*)`;
    const endTokenPattern   = `(/\\*END_${token}\\*\\/)`;
    const contentPattern    = '[\\s\\S]*?';

    const RX = new RegExp(`${beginTokenPattern}${contentPattern}${endTokenPattern}`, 'm');
    if(fileIn.match(RX)){
        fs.writeFileSync(file, fileIn.replace(RX, `$1${text}\n$2`));
    }
}

const injectSkeletorConfig = function(done){
    let skeletorConfig = JSON.parse(fs.readFileSync('./skeletor.json', 'utf-8'));
    let scssFile = `${pkg.config.scss}/base/_maps.scss`;
    let jsFile = `${pkg.config.scripts}/source/breakpoint-controller.js`;

    let scssBreakpointVars = skeletorConfig.breakpoints
        //$small: em(400px);
        .map(b => `\$${b.name}: em(${b.size}px);`)
        .join("\n");

    let scssBreakpointMap = skeletorConfig.breakpoints
        //small: $small,
        .map(b => `${b.name}: \$${b.name},`)
        .join("\n");

    let jsBreakpointExports = skeletorConfig.breakpoints
        //export const SMALL = 400;
        .map(b => `export const ${b.name.toUpperCase()} = ${b.size};`)
        .join("\n");

    // [ SMALL, MEDIUM, LARGE ]
    let jsBreakpointArray = `[ ${ skeletorConfig.breakpoints.map(b => b.name.toUpperCase()).join(', ') } ]`;

    addTextBetweenTokensInFile(scssBreakpointVars, 'SCSS_BREAKPOINT_VARS', scssFile);
    addTextBetweenTokensInFile(scssBreakpointMap, 'SCSS_BREAKPOINT_MAP', scssFile);
    addTextBetweenTokensInFile(jsBreakpointExports, 'JS_BREAKPOINT_EXPORTS', jsFile);
    addTextBetweenTokensInFile(jsBreakpointArray, 'JS_BREAKPOINT_ARRAY', jsFile);

    done();
    return true;
}

module.exports = injectSkeletorConfig;
