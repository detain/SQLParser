phplemon src/SQLParser/Parser.y
plex src/SQLParser/Lexer.lex > /dev/null
sed -i bak "s/SINGLE_QUOTE/\\\\'/g" src/SQLParser/Lexer.php
autoloader generate --relative --library src/autoload.php src 
