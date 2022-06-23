import gql from 'graphql-tag'

export const ALL_PORTFOLIOS_QUERY = gql`query AllPostsQuery($first: Int!, $after: String, $term:String) {
  portfolios (first: $first after: $after where: {taxQuery: {taxArray: {field: SLUG, operator: IN, taxonomy: TIPO, terms: $term}}}) {
    nodes {
      id
      title
      portfolio {
        portfolioName
        portfolioClient
      }
      uri
      featuredImage {
        node {
          sourceUrl(size: MEDIUM_LARGE)
        }
      }
    }
    pageInfo {
      hasNextPage
      endCursor
    }
  }
}`