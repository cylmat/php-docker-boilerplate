SHELL := /bin/bash

cyan = /bin/echo -e "\x1b[36m\#\# $1\x1b[0m"

###############
### PROMPTS ###
###############
fancy-git:
	apt update && apt install -y git fontconfig
	rm -rf $HOME/fancygit
	curl -sS https://raw.githubusercontent.com/diogocavilha/fancy-git/master/install.sh | sh
	@echo -e "\n\033[1;32mEntering new Shell \033[0m"
	@echo -e "\033[1;32mPlease visit: https://github.com/diogocavilha/fancy-git \033[0m"
	@exec $$SHELL

fancy-git-uninstall:
	curl -sS https://raw.githubusercontent.com/diogocavilha/fancy-git/master/uninstall.sh | sh
	@echo -e "\033[1;32mEntering new Shell \033[0m"
	@exec $$SHELL