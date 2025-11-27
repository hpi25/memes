import asyncio
import os

import libsql_client


async def main():  # Connect to the db
    url = os.getenv("DATABASE_URL") or "file:local.db"
    async with libsql_client.create_client(url) as client:  # Create client
        result_set = await client.execute("SELECT * from users")  # test query
        print(len(result_set.rows), "rows")
        for row in result_set.rows:
            print(row)


if __name__ == "__main__":
    asyncio.run(main())
