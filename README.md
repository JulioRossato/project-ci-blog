# **CI Blog** :newspaper:

## About

CI Blog is a bespoke blog/news framework built on some of the most popular open source technologies such as Codeigniter and Vue.js.

## :floppy_disk:  Technologies

Libraries and Frameworks:

- [CodeIgniter](https://codeigniter.com/) is a powerful PHP framework with a very small footprint, built for developers who need a simple and elegant toolkit to create full-featured web applications.
- [REST API](https://www.redhat.com/en/topics/api/what-is-a-rest-api) is an application programming interface that conforms to the constraints of REST architectural style and allows for interaction with RESTful web services.
- [JWT](https://jwt.io/) JSON Web Tokens are an open, industry standard RFC 7519 method for representing claims securely between two parties.


## Installation

#### Requirements

- PHP 7.4
- MySQL (undefined)

#### Configuration

- Create the **.env** file:
```shell
cp env .env
```

- Open the **.env** file and configure the database access

```
database.default.hostname = localhost
database.default.database = ci4
database.default.username = root
database.default.password = root
database.default.DBDriver = MySQLi
# database.default.DBPrefix =
database.default.port = 3306
```

- Install packages
```shell
composer install
```

- Create database tables (CI4 migrations)

```shell
php spark migrate
```

## :books: Best Practices

#### Scrum

Scrum is a lightweight framework that helps people, teams and organizations generate value through adaptive solutions for complex problems\
[https://www.scrum.org/](https://www.scrum.org/)

#### GitFlow

GitFlow is a branching model for Git\
[https://datasift.github.io/gitflow/IntroducingGitFlow.html](https://datasift.github.io/gitflow/IntroducingGitFlow.html)

#### Commit Pattern

In general the pattern mostly looks like this:

`type(scope?): subject  #scope is optional; multiple scopes are supported (current delimiter options: "/", "\" and ",")`
> The scope should be the git issue id

##### Messages exemples

`chore: run tests on travis ci`

`fix(#1): send cors headers`

`feat(#150): add comment section`

##### Common types

- build
- ci
- chore
- docs
- feat
- fix
- perf
- refactor
- revert
- style
- test


## :man_technologist:Software team  :rocket::large_blue_circle:

- Júlio Rossato - Project manager ([contato@julirossato.com.br](mailto:contato@julirossato.com.br))
- Júlio Rossato - Team Leader ([contato@julirossato.com.br](mailto:contato@julirossato.com.br))

##### Development team

