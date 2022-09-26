SHELL := /bin/bash

.PHONY: network

###############
### NETWORK ###
###############
network:
	@echo -e "\033[1;32mPlease visit: https://busybox.net \033[0m"
	apt update && apt install -y busybox dnsutils iputils-ping netcat net-tools nmap tcpdump telnet

###############
### PROMPTS ###
###############
bash-it:
	apt update && apt install -y git
	rm -rf $$HOME/.bash_it
	git clone --depth=1 https://github.com/Bash-it/bash-it.git $$HOME/.bash_it
	echo "y" | $$HOME/.bash_it/install.sh
	@echo "\n"
	@echo -e "\033[1;32mEntering new Shell \033[0m"
	@echo -e '\033[1;32mUse "$$ bash-it" command shell \033[0m'
	@echo -e "\033[1;32mPlease visit: https://bash-it.readthedocs.io \033[0m"
	exec $$SHELL

bash-it-uninstall:
	$$BASH_IT/uninstall.sh
	rm -rf $$HOME/.bash_it
	exec $$SHELL

fancy-git:
	apt update && apt install -y git fontconfig
	rm -rf $$HOME/fancygit
	curl -sS https://raw.githubusercontent.com/diogocavilha/fancy-git/master/install.sh | sh
	@echo "\n"
	@echo -e "\033[1;32mEntering new Shell \033[0m"
	@echo -e "\033[1;32mPlease visit: https://github.com/diogocavilha/fancy-git \033[0m"
	exec $$SHELL

fancy-git-uninstall:
	curl -sS https://raw.githubusercontent.com/diogocavilha/fancy-git/master/uninstall.sh | sh
	@echo -e "\033[1;32mEntering new Shell \033[0m"
	exec $$SHELL