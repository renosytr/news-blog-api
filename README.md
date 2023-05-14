# News Blog API

![News Blog API](https://images.unsplash.com/photo-1585282263861-f55e341878f8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80)

This is a ready to consume back-end API for content management system (CMS) built using Laravel. It is a simple solution for building CMS API without getting distracted on its layout. Because, now, we can use separate architecture between back-end and front-end. Thus, you will find that the resources folder is empty. 

## Purpose

The main purpose of this API is to provide key services of CMS, such as news portal and blogging website specifically. The feature included in this API are followed below:

1.  User management for reader, writter and superuser. Some features which are supported are:
    - CRUD new user account
    - Role specification
    - Forgot password procedure
    - Email verification
    - Recover deleted user account
    - Add featured writter

2.  Posting management, the feature are as follow:
    - CRUD article by writter type of user
    - Article categorization
    - CRUD comment of an article
    - Like and dislike a post
    - Like and dislike a comment
    - Autocomplete and suggestion for searching an article
    - Add featured post

3.  Follow management, the feature are as follow:
    - Follow and unfollow a writter by reader
    - Get following and follower list

## Authentication

This project is using token based authentication system implemented using Laravel Sanctum. It is lightweight and well-suited for single page applications and mobile applications. These tokens is used to grant scopes which specify which actions the tokens are allowed to perform. Please refer to the original documentation of [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum) to get more information. 

## Specification

1.  Laravel 10.2
2.  PHP 8.1
3.  MySQL 5.7

## How to Run

Navigate to the following steps to run this project.

1.  Clone this project to your local
2.  Run in terminal sequentially
    - `$ composer install` 
    - `$ php artisan key:generate`
    - `$ php artisan migrate`
    - `$ php artisan serve`
4.  Server is ready
5.  List of the API can be found here `news-blog-api.postman_collection.json` 
6.  Import the file to [Postman](https://www.postman.com/), download if you don't have it
7.  Finish
