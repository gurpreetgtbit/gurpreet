CREATE TABLE IF NOT EXISTS `Order Register1` (
  `Order ID` varchar(20) NOT NULL,
  `Invoice Number` varchar(20) NOT NULL,
  `Invoice Date` date NOT NULL,
  `Order Date` date NOT NULL,
 `Customer ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Order Register1`
 ADD PRIMARY KEY (`Order ID`), ADD KEY `ORDER_CUSTOMER_ID` (`Customer ID`);
CREATE TABLE IF NOT EXISTS `Product1` (
  `ID` int(20) NOT NULL,
  `Order ID` varchar(20) NOT NULL,
  `Product ID` int(11) NOT NULL,
  `Unit Price` decimal(10,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Tax ID` int(11) NOT NULL,
  `Tax Amount` decimal(10,2) NOT NULL,
  `Shipping Cost` decimal(10,2) NOT NULL,
  `Total Amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Product1`
 ADD PRIMARY KEY (`ID`), ADD KEY `ORDER_PRODUCT_ID` (`Product ID`);
