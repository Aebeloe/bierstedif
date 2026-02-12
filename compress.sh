#!/bin/bash
cd /home/mma/bierstedif

rm -f /home/mma/bierstedif.zip

# Zip everything except .claude and the dev .env/.env.prod files
zip -r /home/mma/bierstedif.zip . -x "./.claude/*" "./.env" "./.env.prod" "./.git/*" "./.idea/*" "./public/hot" "./node_modules/*"

# Add .env.prod as .env inside the zip
zip /home/mma/bierstedif.zip --junk-paths -0 .env.prod
printf "@ .env.prod\n@=.env\n" | zipnote -w /home/mma/bierstedif.zip

echo "Compressed to /home/mma/bierstedif.zip"
