The directories I've added explanation for are:

## App\Exceptions\handler:
This directory I handle exception

## App\Services:
store service classes that encapsulate specific
business logic or perform certain functionalities that don't fit within the scope of controllers, models, or other
primary application components.

## App\Traits\Response:
This directory to return data to the client. Responses
can be crafted within controller methods or service classes and returned back to the user's request. to namespace

## App\Services\sms:
This directory contains factory,strategy and adopter for calling third-party service

## App\Repositories:
This directory is a place where you can organize and store classes responsible for interacting with your application's data persistence layer, usually the database.

## App\Repositories\base:
This directory has base repository that contains common method that other repositories extend it


## App\Broadcasting\Channels:
This directory contains custom notification channels.
Channels are used to define and implement custom delivery methods for notifications.

## App\Notifications:
This directory includes custom notification drivers.
Notification drivers define how notifications are sent through various channels.
They encapsulate the logic required to send notifications via different
services or platforms.
