/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Hendri Gunawan
 * Created: May 30, 2017
 */

ALTER TABLE `customer`
ADD `photo_identity_number` varchar(100) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `identity_number`;

ALTER TABLE `transaction`
CHANGE `driver_id` `driver_id` int(11) NULL AFTER `car_id`;

ALTER TABLE `transaction`
CHANGE `created_at` `created_at` datetime NULL AFTER `user_id`,
CHANGE `updated_at` `updated_at` datetime NULL AFTER `created_at`,
CHANGE `created_by` `created_by` int(11) NULL AFTER `updated_at`,
CHANGE `updated_by` `updated_by` int(11) NULL AFTER `created_by`;

ALTER TABLE `transaction`
CHANGE `rent_at` `rent_at` date NOT NULL AFTER `driver_id`,
CHANGE `rent_finish_at` `rent_finish_at` date NOT NULL AFTER `rent_at`;