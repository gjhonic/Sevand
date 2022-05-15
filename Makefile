# See docs
#  * https://guides.hexlet.io/makefile-as-task-runner/
#  * http://www.network-science.de/ascii/

#### Makefile global configuration
.PHONY: build
.DEFAULT_GOAL := help
SHELL = /bin/bash

#### Predefined global variables/functions
# Colors for SH scripts. See https://www.shellhacks.com/bash-colors/
CE           = \033[0m
C_RED        = \033[0;31m
C_GREEN      = \033[0;32m
C_YELLOW     = \033[0;33m
C_TITLE      = \033[0;30;46m

# Paths
PATH_ROOT    = `pwd`
PATH_SRC     ?= $(PATH_ROOT)
PATH_BUILD   ?= $(PATH_ROOT)/build

# Other
PROC_NUM          ?= 4
PHP_MEMORY_LIMIT  ?= 2G
PATH_POSTFIX      ?= Default

#### Helper Functions
# Pretty print for `make help`
HELP_FUNCTION =                                                              \
    %help; while(<>){push@{$$help{$$2//'Misc'}},[$$1,$$3]                    \
    if/^([\w-_]+)\s*:.*\#\#(?:@(\w+))?\s(.*)$$/};                            \
    print"$$_:\n", map"  $$_->[0]".(" "x(30-length($$_->[0])))."$$_->[1]\n", \
    @{$$help{$$_}},"\n" for keys %help;

# Render colored title before executing a command
define title
    @echo ""
    @echo -e "$(C_YELLOW)>>>> >>>> >>>> >>>> >>>> >>>> $(C_TITLE) $(1) $(CE)"
endef


#### Makefile-level Actions ############################################################################################

help: ## To see this description
	@echo -e "$(C_YELLOW)                                   __$(CE)"
	@echo -e "$(C_YELLOW)   ________ _   ______ _____  ____/ /$(CE)"
	@echo -e "$(C_YELLOW)  / ___/ _ \ | / / __ \`/ __ \/ __  / $(CE)"
	@echo -e "$(C_YELLOW) (__  )  __/ |/ / /_/ / / / / /_/ /  $(CE)"
	@echo -e "$(C_YELLOW)/____/\___/|___/\__,_/_/ /_/\__,_/   $(CE)"
	@echo -e "$(C_GREEN)                 http://sevand.ru     $(CE)"
	@echo ""
	@echo "Command line interface for super global app actions."
	@echo ""
	@echo "Usage:"
	@echo "  * make [target]"
	@echo "  * ENV_VAR=value make [target]"
	@echo "  * make [target] OPTION_NAME=value"
	@echo ""
	@perl -e '$(HELP_FUNCTION)' $(MAKEFILE_LIST)
	@echo ""

#### Global Project Actions ############################################################################################
build: ##@Project Build Project
	@make off
	@echo -e "$(C_YELLOW)>>> >>> >>> >>> $(C_GREEN)Build Project$(CE)"
	@echo -e "$(C_YELLOW) 1. composer install$(CE)"
	@composer install
	@echo -e "$(C_YELLOW) 2. create env files$(CE)"
	@cp "$(PATH_ROOT)/web/.env.sample" "$(PATH_ROOT)/web/.env"
	@cp "$(PATH_ROOT)/config/.env.sample" "$(PATH_ROOT)/web/.env"
	@make on

clear-tmp: ##@Project Clear generated files
	@echo -e "$(C_YELLOW)1. Clearing the cache $(CE)"
	@make clear-cache
	@echo -e "$(C_YELLOW)2. Clearing the assets$(CE)"
	@make clear-assets
	@echo -e "$(C_YELLOW)3. Clearing the debug$(CE)"
	@make clear-debug
	@echo -e "$(C_GREEN)Completed$(CE)"


#### Clears Actions ############################################################################################
clear-cache: ##@Clear cache files
	@rm -rf "$(PATH_ROOT)/runtime/cache/"
	@mkdir "$(PATH_ROOT)/runtime/cache"
	@echo -e "$(C_GREEN)Cache cleared$(CE)"

clear-assets: ##@Clear Clear assets files
	@rm -rf "$(PATH_ROOT)/web/assets/"
	@mkdir "$(PATH_ROOT)/web/assets"
	@echo -e "$(C_GREEN)Assets cleared$(CE)"

clear-debug: ##@Clear Clear debug files
	@rm -rf "$(PATH_ROOT)/runtime/debug/"
	@mkdir "$(PATH_ROOT)/runtime/debug"
	@echo -e "$(C_GREEN)Debug cleared$(CE)"

#### Testing Actions ###################################################################################################
codestyle: ##@Testing Run a full check with all available linters.
	@echo -e "$(C_YELLOW)>>> >>> >>> >>> $(C_GREEN)Test Syntax$(CE)"


#### Offline Mode ######################################################################################################
on: ##@Application Enable Offline Mode
	@echo -e "$(C_YELLOW)>>> >>> >>> >>> $(C_GREEN)Offline Mode: OFF$(CE)"
	@rm -f "$(PATH_ROOT)/web/offline.php"


off: ##@Application Disable Offline Mode
	@echo -e "$(C_YELLOW)>>> >>> >>> >>> $(C_RED)Offline Mode: ON$(CE)"
	@cp "$(PATH_ROOT)/web/offline.php.sample" "$(PATH_ROOT)/web/offline.php"
