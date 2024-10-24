This project is an admin portal for managing an e-Commerce website that sells cellphones. The portal allows users to perform CRUD operations (Create, Retrieve, Update, Delete) on cellphone inventory, with all the data stored in a MySQL database. The MySQL table is named cellphones and includes the following fields:

CellphoneID: Unique identifier for each cellphone.
CellphoneName: Name of the cellphone.
Description: Description of the cellphone.
QuantityAvailable: Number of cellphones in stock.
Price: Price of the cellphone.
ProductAddedBy: Hardcoded with the name "Aditya Mahajan".
Color: An additional field chosen for this product, representing the color of the cellphone.
The project uses prepared statements for secure SQL queries and PHP validation for all user inputs. The pages are self-processing, meaning the forms post to themselves for data submission, ensuring a streamlined experience without redirection. The UI can optionally use Bootstrap for improved aesthetics.
