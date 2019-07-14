# Exchange Rate App

######Exchange rate - NBRM


## API endpoints
- `GET /api/search/@name` - search by full name
- `GET /api/search/like/@name` - search like keyword

## Devbox with Docker container for API

### Build the image:

- navigate to root folder `cd api`

- `docker build -t exchange-rate-api:latest -f docker/Dockerfile .`

### Run the container from image

- `docker run -p 8080:80 -d -v $(pwd):/var/www/exchange-rate-api exchange-rate-api`


