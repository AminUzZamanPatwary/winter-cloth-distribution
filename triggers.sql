DELIMITER //

-- 1. Reduce stock after distribution
CREATE TRIGGER reduce_stock
AFTER INSERT ON Distribution
FOR EACH ROW
BEGIN
    UPDATE Cloth
    SET quantity = quantity - NEW.quantity
    WHERE cloth_id = NEW.cloth_id;
END //

-- 2. Prevent negative stock
CREATE TRIGGER prevent_negative_stock
BEFORE INSERT ON Distribution
FOR EACH ROW
BEGIN
    DECLARE stock INT;

    SELECT quantity INTO stock
    FROM Cloth
    WHERE cloth_id = NEW.cloth_id;

    IF NEW.quantity > stock THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Not enough stock';
    END IF;
END //

DELIMITER ;