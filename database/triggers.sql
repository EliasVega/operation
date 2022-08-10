DELIMITER //
CREATE TRIGGER tr_updStockRemission AFTER INSERT ON operation_remissions
FOR EACH ROW
BEGIN
    UPDATE operations SET stock = stock + NEW.quantity
    WHERE operations.id = NEW.operation_id;
END
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_updStockOpePartial AFTER INSERT ON operating_partials
FOR EACH ROW
BEGIN
    UPDATE operations SET stock = stock - NEW.quantity
    WHERE operations.id = NEW.operation_id;
END
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_updStockPartial AFTER INSERT ON operating_partials
FOR EACH ROW
BEGIN
    UPDATE operatings SET operating = operating - NEW.quantity
    WHERE operatings.id = NEW.operating_id;
END
//
DELIMITER ;

