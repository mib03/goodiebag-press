###################
Goodie Bag Press Warehouse Management System
###################

This is a website-based Warehouse Management System application website-based for a small business called Goodie Bag Press.  
The application was built using CodeIgniter 3.1.11, Bootstrap 4.5, and jQuery.  
The overall interface creation and features are assisted by SB Admin 2 template.  
The language available is only for Indonesian.  

*******************
Feature
*******************

- Cards contains:
  • Total items
  • Total of items purchase (monthly)
  • Incoming items (monthly)
  • Outcoming items (monthly)
- Top 5 Shortage stock
- Top 5 surplus stock
- Master data
  You can add, edit, and delete them in:
  • Item data
  • Transportation data
  • Distribution data
  • Supplier data
  • User data
- Purchase order
- Items Transaction contains:
  • Incoming item transaction
  • Outcoming item transaction
- Delivery order
- Report contains:
  • Item stock report (all data)
  • Purchase order report (all data or period)
  • Purchase order details report (all data)
  • Incoming items report (all data or period)
  • Outcoming items report (all data or period)
  • Delivery order report (all data or period)
- Edit profile

**************************
User 
**************************
Users on this application are divided into two. The users are:
- Admin
  They can manage all available features.
- Operator
  They have limited access. Not like Admin, the feature available is only purchase order, items transaction, delivery order, and item stock report.

**************************
Composition
**************************

- HTML            - PHP
- CSS             - Bootstrap 4.5
- JavaScript      - CodeIgniter 3.1.11
- jQuery          - SB Admin 2 template

*******************
How to use?
*******************

1. Login with your valid account
2. Create a new purchase order. Make sure you have at least one data in master data.
3. Create a new item order. Input valid data on the modal window of item order.
4. Submit item order list you already input.
5. Input valid delivery order data, submit.
6. Input incoming item with the appropriate value to the purchase order.
7. If you get order by customers, input the outcoming value corresponding to the demand.
8. Check on the report menu according to your needs to see changes in transactions that have been running.

*********
Resources
*********

-  `CodeIgniter 3 <https://github.com/bcit-ci/CodeIgniter>`_
-  `Bootstrap 4.5 <https://getbootstrap.com/docs/4.5/getting-started/introduction/>`_
-  `SB Admin 2 <https://startbootstrap.com/theme/sb-admin-2>`_
-  `Goodie Bag Press <http://goodiebagpress.com/>`_
