# FAYM Bank

Banking Web app allowing user authentification and money transfers between user accounts.

Developed with PHP's framwork Laravel, Blade, Bootstrap, HTML and CSS.

Team project where I developed the databases, the backend, the models, users auth and money transfers processing.


## Project requirements

The user should be able to perform the following things:
- Should be able to login into the account.
- Should be able to see all the transactions.
- Should be able to add a contact so that he/she can send money.
- Should have an option to cancel the money within two hours which will work if the receiver
didn’t receive it yet. (Think about having a flag whether the user is received or not)
- Receiver gets the money and it should show the updated amount on their accounts.
- For security purposes, if the user enters the wrong password three times, block their
account for 10 mins.
- Option to update personal information.


## System Design

   ###### DATABASE DESIGN
   - Database design will be implemented as specified in the ER diagram:
   
   ![ER_Diagram.png](ER_Diagram.png)
   
   Database tables will be created using migration scripts in Migration folder


   ###### USE-CASES
   - Application use cases and scenarios:
   
   ![FAYM-Use-Cases.jpg](FAYM-Use-Cases.jpg)



## Project structure

##### App folder:
```
+---Console
|       Kernel.php
|
+---Exceptions
|       Handler.php
|
+---Http
|   |   Kernel.php
|   |
|   +---Controllers
|   |   |   AccountController.php
|   |   |   ContactController.php
|   |   |   Controller.php
|   |   |   HomeController.php
|   |   |   TransactionController.php
|   |   |   UserController.php
|   |   |
|   |   \---Auth
|   |           ConfirmPasswordController.php
|   |           ForgotPasswordController.php
|   |           LoginController.php
|   |           RegisterController.php
|   |           ResetPasswordController.php
|   |           VerificationController.php
|   |
|   \---Middleware
|           Authenticate.php
|           EncryptCookies.php
|           PreventRequestsDuringMaintenance.php
|           RedirectIfAuthenticated.php
|           TrimStrings.php
|           TrustHosts.php
|           TrustProxies.php
|           VerifyCsrfToken.php
|
+---Models
|       Account.php
|       Contact.php
|       Transaction.php
|       User.php
|
+---Observers
|       TransactionObserver.php
|
\---Providers
        AppServiceProvider.php
        AuthServiceProvider.php
        BroadcastServiceProvider.php
        EventServiceProvider.php
        RouteServiceProvider.php

```


#### Database folder:
```
|
+---factories
|       AccountFactory.php
|       ContactFactory.php
|       TransactionFactory.php
|       UserFactory.php
|
+---migrations
|       2014_10_12_000000_create_users_table.php
|       2014_10_12_100000_create_password_resets_table.php
|       2019_08_19_000000_create_failed_jobs_table.php
|       2019_12_14_000001_create_personal_access_tokens_table.php
|       2022_03_26_030917_create_accounts_table.php
|       2022_03_26_033118_create_transactions_table.php
|       2022_03_27_043912_create_contacts_table.php
|
\---seeders
        DatabaseSeeder.php
```


#### Config folder:
```
    app.php
    auth.php
    broadcasting.php
    cache.php
    cors.php
    database.php
    filesystems.php
    hashing.php
    logging.php
    mail.php
    queue.php
    sanctum.php
    services.php
    session.php
    view.php
```


## Documentation
   ###### PURPOSE OF THE PRODUCT DESIGN SPECIFICATION DOCUMENT
The FAYM Bank Delivery document documents and tracks the necessary information required to effectively define architecture and system design to give the development team guidance on architecture of the system to be developed. The FAYM Bank Delivery document is created during the tying together of the front and back ends of the first iteration of the FAYM Bank system. Its intended audience is the project manager, project team, and development team of the active FAYM Bank system.
#### GENERAL OVERVIEW AND DESIGN GUIDELINES/APPROACH
This section describes the principles and strategies to be used as guidelines when designing and implementing the system.
###### ASSUMPTIONS / CONSTRAINTS / STANDARDS
Resources:

- Bank staff will be available to test and learn the system during agreed upon times before opening system to clients
- Conference rooms/Presentation spaces will be available at the bank as required

Delivery:

- Bank servers arrive configured as expected
- Secondary servers arrive configured for regular backups of database

Budget:

- Project costs will stay the same as initially budgeted
- Initial training will be conducted on-site at bank with no additional costs

Finances:

- Funding for domains, database hosting, and software licensing will be provided by bank coordinators

Scope:

- Project scope is not subject to change following sign-off of bank coordinators on scope statement

Schedule:

- Materials will arrive within project schedule
- Training contracts will be completed within two weeks of commencing

Methodology:

- Project will follow agile methodology throughout execution
- Project will follow team governance guidelines and requirements

Technology:

- FAYM Bank System will be written and executed in PHP
- FAYM Bank System will use Laravel PHP Framework
- FAYM Bank System database storage will be facilitated with database hosting services
#### ARCHITECTURE DESIGN
   - The FAYM Bank System will utilize REST API architecture
   ###### LOGICAL VIEW
   - Logical views can be found in Views folder\*
   ###### HARDWARE ARCHITECTURE
   - The FAYM Bank System will run on-site with emergency action capabilities to shut down or make changes
   - The FAYM Bank System database will reside in an offsite cloud, with regular onsite backups
   ###### SOFTWARE ARCHITECTURE
   - The FAYM Bank System database will be modelled as seen in [ER_Diagram.png](ER_Diagram.png)
   - Tables will be created using scripts in Migrations folder\*
   ###### SECURITY ARCHITECTURE
   - The FAYM Bank System employs Laravel PHP Framework for guaranteeing secure client authentications while moving from page to page as well as ensuring database security
   ###### COMMUNICATION ARCHITECTURE
   - The FAYM Bank System employs Laravel PHP Framework for communication between onsite server and offsite cloud database


###### USER INTERFACE DESIGN
- User Interface Design will be controlled by blade.php scripts that can be located inside the Views folder\*


#### Appendix A: References

Views folder -> Delivery\BankingPHP\resources\views

Migrations folder -> Delivery\BankingPHP\database\migrations

Use\_Cases.pdf -> Delivery\Use\_Cases.pdf


