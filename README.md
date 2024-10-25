## NYT Bestsellers

A single endpoint to fetch a JSON list of bestsellers from the New York Times.

GET /api/1/nyt/best-sellers

Valid parameters are:

- author (string)
- title (string)
- isbn (string) - Valid ISBN is 10 or 13 digits. Multple semicolon-separated ISBNs are allowed.
- offset (integer) - Must be multiples of 20. Zero or no value is allowed.
