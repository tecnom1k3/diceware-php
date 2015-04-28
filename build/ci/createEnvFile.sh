#!/bin/bash
cp .env.example .env
perl -p -i -e "s/# FILESYSTEM_DRIVER=local/FILESYSTEM_DRIVER=local/g" .env