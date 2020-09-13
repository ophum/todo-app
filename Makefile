user=$(shell id -u):$(shell id -g)
DockerCompose = user="$(user)" docker-compose

.PHONY: run
run:
	$(DockerCompose) up -d
	
.PHONY: down
down:
	$(DockerCompose) down

.PHONY: logs
logs:
	$(DockerCompose) logs -f

.PHONY: runShellPHP
runShellPHP:
	$(DockerCompose) run php bash

.PHONY: execShellPHP
execShellPHP:
	$(DockerCompose) exec php bash
	
