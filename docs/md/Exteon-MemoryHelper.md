Exteon\MemoryHelper
===============

This helper class is used to perform some common PHP memory management
operations




* Class name: MemoryHelper
* Namespace: Exteon
* This is an **abstract** class







Methods
-------


### getMemoryLimit

    integer Exteon\MemoryHelper::getMemoryLimit()

Gets the current memory limit, in bytes



* Visibility: **public**
* This method is **static**.




### increaseMemoryLimit

    mixed Exteon\MemoryHelper::increaseMemoryLimit(string $amount)

Increases memory limit by the specified amount



* Visibility: **public**
* This method is **static**.


#### Arguments
* $amount **string**



### setMemoryLimit

    mixed Exteon\MemoryHelper::setMemoryLimit(string $amount)

Sets the memory limit for the PHP script



* Visibility: **public**
* This method is **static**.


#### Arguments
* $amount **string**



### doWithIncreasedMemory

    mixed Exteon\MemoryHelper::doWithIncreasedMemory(string $amount, callable $callback)

Runs the supplied callback with an increased memory limit



* Visibility: **public**
* This method is **static**.


#### Arguments
* $amount **string**
* $callback **callable**



### bytesFromPhpIniString

    integer Exteon\MemoryHelper::bytesFromPhpIniString(string $val)

Parses the value in Php .ini memory size format (i.e. '100M') into
the numeric byte size



* Visibility: **public**
* This method is **static**.


#### Arguments
* $val **string**


