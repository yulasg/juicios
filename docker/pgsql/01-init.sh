#!/usr/bin/env bash
set -e

#################
# DOCUMENTACIÓN #
#################

# Este script permite crear los esquemas necesarios, SOLAMENTE cuando se crea
# la base de datos por primera vez, ya que, según la documentación oficial de
# del Docker Hub de Postgres (https://hub.docker.com/_/postgres/), los scripts
# definidos en /docker-entrypoint-initdb.d se ejecutan si la carpeta de datos
# de postgres está vacía, es decir, si ya existe una base de datos este script
# no se volverá a ejecutar.

# Luego de que se crean los esquemas necesarios, se modifica la variable
# search_path para que incluya los esquemas anteriormente creados. Por lo tanto,
# si se crean nuevos esquemas, éstos también se deben incluir en el search_path.
# Más info acerca de qué es search_path y cómo funciona:
# - https://www.postgresql.org/docs/current/ddl-schemas.html
# - https://www.postgresql.org/docs/current/runtime-config-client.html
# - https://www.postgresqltutorial.com/postgresql-schema/

#psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
#    CREATE SCHEMA IF NOT EXISTS bienes_inmuebles;
#    CREATE SCHEMA IF NOT EXISTS obras_artes;
#   ALTER DATABASE "$POSTGRES_DB" SET search_path TO public, bienes_inmuebles, obras_artes;
#EOSQL
