# Makefile

.PHONY: all
all: install

.PHONY: install
install:
	composer install

.PHONY: build
build: install

.PHONY: clean
clean:
	# Commandes pour nettoyer les artefacts de build
