## NYT Bestsellers

A single endpoint to fetch a JSON list of bestsellers from the New York Times.

GET /api/1/nyt/best-sellers

Valid parameters are:

- author (string)
- title (string)
- isbn (string) - Multple semicolon-separated ISBNs are allowed
- offset (string) - Must be multiples of 20
