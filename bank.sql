SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*Database bank*/

CREATE TABLE `branch` (
  `branchId` int(11) NOT NULL,
  `branchNo` varchar(111) NOT NULL,
  `branchName` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `branch` (`branchId`, `branchNo`, `branchName`) VALUES ('3', '100103', 'Udupi'), ('4', '100104', 'Kaup');


CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(111) NOT NULL,
  `password` varchar(111) NOT NULL,
  `type` varchar(111) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `login` (`id`, `email`, `password`, `type`, `date`) VALUES ('7', 'john@gmail.com', '123456', 'customer', current_timestamp());


CREATE TABLE `otheraccounts` (
  `id` int(11) NOT NULL,
  `accountNo` varchar(111) NOT NULL,
  `bankName` set default="RID",
  `holderName` varchar(111) NOT NULL,
  `balance` varchar(111) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `otheraccounts` (`id`, `accountNo`, `holderName`, `balance`, `date`) VALUES ('7', '12001127', 'John', '50000', current_timestamp());



CREATE TABLE `transaction` (
  `transactionId` int(11) NOT NULL,
  `action` varchar(111) NOT NULL,
  `credit` varchar(111) NOT NULL,
  `debit` varchar(111) NOT NULL,
  `other` varchar(111) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `transaction` (`transactionId`, `action`, `credit`, `debit`, `other`, `date`) VALUES ('37', 'Credit', '500', '', '12001127', current_timestamp());

CREATE TABLE `useraccounts` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `accountType` varchar(111) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `number` varchar(111) NOT NULL,
   `address` varchar(111) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  
  `balance` varchar(111) NOT NULL,
  `accountNo` varchar(111) NOT NULL,
  `branch` varchar(111) NOT NULL,
  
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `useraccounts` (`id`, `email`, `password`, `name`, `balance`, `number`, `address`, `accountNo`, `branch`, `accountType`, `date`) VALUES ('7', 'john@gmail.com', '123456', 'John', '50000', '987654321', 'shanthi nagar Udupi', '12001127', 'Udupi', 'Savings', current_timestamp());

ALTER TABLE `branch`
  ADD PRIMARY KEY (`branchId`);
  ALTER TABLE `branch`
  MODIFY `branchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);
  ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `otheraccounts`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `otheraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionId`);
  ALTER TABLE `transaction`
  MODIFY `transactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

  ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`id`);
  ALTER TABLE `useraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
